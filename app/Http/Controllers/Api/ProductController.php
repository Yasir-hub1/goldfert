<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return response()->json($products);
    }

    /**
     * Obtener productos habilitados para el catálogo público
     */
    public function publicIndex()
    {
        $products = Product::where('enabled', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'nombre' => $product->nombre,
                    'foto' => $product->foto ? asset('storage/' . $product->foto) : null,
                    'precio' => $product->precio,
                    'dosis' => $product->dosis,
                    'descripcion' => $product->descripcion,
                    'cultivo' => $product->cultivo,
                    'etapa' => $product->etapa,
                ];
            });

        return response()->json($products);
    }

    /**
     * Obtener detalle de un producto habilitado
     */
    public function publicShow(string $id)
    {
        $product = Product::where('enabled', true)->findOrFail($id);

        return response()->json([
            'id' => $product->id,
            'nombre' => $product->nombre,
            'foto' => $product->foto ? asset('storage/' . $product->foto) : null,
            'precio' => $product->precio,
            'dosis' => $product->dosis,
            'descripcion' => $product->descripcion,
            'cultivo' => $product->cultivo,
            'etapa' => $product->etapa,
            'created_at' => $product->created_at,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'precio' => 'nullable|numeric|min:0',
                'dosis' => 'nullable|string|max:255',
                'descripcion' => 'nullable|string',
                'cultivo' => 'nullable|string|max:255',
                'etapa' => 'nullable|string|max:255',
                'enabled' => 'nullable',
            ], $this->getValidationMessages());

            // Convertir enabled a boolean
            $validated['enabled'] = $this->convertToBoolean($request->input('enabled', true));
            
            // Asegurar que precio sea numérico, si no viene o es null, usar 0 por defecto
            $validated['precio'] = $request->has('precio') && $request->input('precio') !== null 
                ? (float) $validated['precio'] 
                : 0;

            if ($request->hasFile('foto')) {
                try {
                    $validated['foto'] = $this->processImage($request->file('foto'));
                } catch (\Exception $e) {
                    \Log::error('Error al procesar imagen: ' . $e->getMessage());
                    throw new \Exception('Error al procesar la imagen: ' . $e->getMessage());
                }
            }

            $product = Product::create($validated);

            return response()->json([
                'message' => 'Producto creado exitosamente',
                'product' => $product
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el producto: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);

            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:25600', // 25MB máximo - se comprimirá automáticamente
                'precio' => 'nullable|numeric|min:0',
                'dosis' => 'nullable|string|max:255',
                'descripcion' => 'nullable|string',
                'cultivo' => 'nullable|string|max:255',
                'etapa' => 'nullable|string|max:255',
                'enabled' => 'nullable',
            ], $this->getValidationMessages());

            // Convertir enabled a boolean
            $validated['enabled'] = $this->convertToBoolean($request->input('enabled', $product->enabled));
            
            // Asegurar que precio sea numérico, si no viene o es null, mantener el valor actual o usar 0
            if ($request->has('precio') && $request->input('precio') !== null) {
                $validated['precio'] = (float) $validated['precio'];
            } else {
                $validated['precio'] = $product->precio ?? 0;
            }

            if ($request->hasFile('foto')) {
                try {
                    // Eliminar foto anterior si existe
                    if ($product->foto) {
                        Storage::disk('public')->delete($product->foto);
                    }
                    $validated['foto'] = $this->processImage($request->file('foto'));
                } catch (\Exception $e) {
                    \Log::error('Error al procesar imagen: ' . $e->getMessage());
                    throw new \Exception('Error al procesar la imagen: ' . $e->getMessage());
                }
            }

            $product->update($validated);

            return response()->json([
                'message' => 'Producto actualizado exitosamente',
                'product' => $product
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el producto: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            
            // Eliminar foto si existe
            if ($product->foto) {
                Storage::disk('public')->delete($product->foto);
            }

            $product->delete();

            return response()->json([
                'message' => 'Producto eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el producto: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Convertir valor a boolean
     */
    private function convertToBoolean($value): bool
    {
        if ($value === null) {
            return true;
        }

        if (is_bool($value)) {
            return $value;
        }

        if (is_string($value)) {
            return in_array(strtolower($value), ['1', 'true', 'yes', 'on'], true);
        }

        return (bool) $value;
    }

    /**
     * Procesar y optimizar imagen usando GD nativo de PHP
     * Optimizado para reducir significativamente el tamaño del archivo
     */
    private function processImage($file): string
    {
        try {
            // Verificar que GD esté disponible
            if (!extension_loaded('gd')) {
                throw new \Exception('GD extension no está disponible');
            }

            // Obtener información de la imagen
            $imageInfo = getimagesize($file->getRealPath());
            if ($imageInfo === false) {
                throw new \Exception('No se pudo leer la información de la imagen');
            }

            list($originalWidth, $originalHeight, $imageType) = $imageInfo;

            // Dimensiones máximas más pequeñas para productos (800px de ancho máximo)
            // Esto reduce significativamente el tamaño del archivo
            $maxWidth = 800;
            $maxHeight = 800;

            // Calcular nuevas dimensiones manteniendo proporción
            $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight, 1);
            $newWidth = (int)($originalWidth * $ratio);
            $newHeight = (int)($originalHeight * $ratio);

            // Crear imagen desde archivo según el tipo
            $sourceImage = null;
            switch ($imageType) {
                case IMAGETYPE_JPEG:
                    $sourceImage = imagecreatefromjpeg($file->getRealPath());
                    break;
                case IMAGETYPE_PNG:
                    $sourceImage = imagecreatefrompng($file->getRealPath());
                    break;
                case IMAGETYPE_GIF:
                    $sourceImage = imagecreatefromgif($file->getRealPath());
                    break;
                case IMAGETYPE_WEBP:
                    if (function_exists('imagecreatefromwebp')) {
                        $sourceImage = imagecreatefromwebp($file->getRealPath());
                    }
                    break;
                default:
                    throw new \Exception('Formato de imagen no soportado');
            }

            if ($sourceImage === false || $sourceImage === null) {
                throw new \Exception('No se pudo crear la imagen desde el archivo');
            }

            // Crear nueva imagen redimensionada
            $newImage = imagecreatetruecolor($newWidth, $newHeight);

            // Para mejor compresión, convertir todo a JPEG excepto si es PNG con transparencia real
            // Para simplificar, solo preservamos transparencia si es PNG, de lo contrario usamos JPEG
            $isPngWithAlpha = ($imageType == IMAGETYPE_PNG);
            
            if ($isPngWithAlpha) {
                // Preservar transparencia para PNG
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
                $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
                imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
            } else {
                // Fondo blanco para imágenes sin transparencia (mejor compresión en JPEG)
                $white = imagecolorallocate($newImage, 255, 255, 255);
                imagefill($newImage, 0, 0, $white);
            }

            // Usar imagecopyresampled para mejor calidad al redimensionar
            imagecopyresampled(
                $newImage,
                $sourceImage,
                0, 0, 0, 0,
                $newWidth,
                $newHeight,
                $originalWidth,
                $originalHeight
            );

            // Convertir todas las imágenes a JPEG para mejor compresión (excepto PNG con transparencia)
            // JPEG tiene mejor relación calidad/tamaño para fotos de productos
            $useJpeg = !$isPngWithAlpha;
            
            if ($useJpeg) {
                // Guardar como JPEG con calidad optimizada (75% - buen balance calidad/tamaño)
                $filename = uniqid() . '_' . time() . '.jpg';
                $path = 'products/' . $filename;
                $fullPath = storage_path('app/public/' . $path);
                
                // Crear directorio si no existe
                $directory = dirname($fullPath);
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                $saved = imagejpeg($newImage, $fullPath, 75); // Calidad 75% (reducido de 85%)
            } else {
                // Para PNG con transparencia, usar compresión máxima
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = uniqid() . '_' . time() . '.' . $extension;
                $path = 'products/' . $filename;
                $fullPath = storage_path('app/public/' . $path);
                
                // Crear directorio si no existe
                $directory = dirname($fullPath);
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                // Compresión máxima para PNG (nivel 9)
                $saved = imagepng($newImage, $fullPath, 9);
            }

            // Liberar memoria inmediatamente
            imagedestroy($sourceImage);
            imagedestroy($newImage);

            if (!$saved) {
                throw new \Exception('No se pudo guardar la imagen optimizada');
            }

            // Verificar tamaño del archivo resultante
            $fileSize = filesize($fullPath);
            $maxFileSize = 2 * 1024 * 1024; // 2MB máximo
            
            if ($fileSize > $maxFileSize) {
                // Si aún es muy grande, reducir más la calidad
                if ($useJpeg) {
                    $newImage = imagecreatefromjpeg($fullPath);
                    imagejpeg($newImage, $fullPath, 60); // Calidad 60%
                    imagedestroy($newImage);
                }
            }

            return $path;
        } catch (\Exception $e) {
            // Log del error
            \Log::error('Error al procesar imagen: ' . $e->getMessage());
            
            // Si el archivo es muy grande, dar un mensaje más específico
            $fileSize = $file->getSize();
            $fileSizeMB = round($fileSize / (1024 * 1024), 2);
            
            if ($fileSize > 20 * 1024 * 1024) {
                throw new \Exception("La imagen es muy grande (${fileSizeMB}MB). Por favor, intenta con una imagen más pequeña o comprímela antes de subirla.");
            }
            
            throw new \Exception('Error al procesar la imagen: ' . $e->getMessage() . '. Por favor, verifica que la imagen sea válida e intenta de nuevo.');
        }
    }

    /**
     * Mensajes de validación en español
     */
    private function getValidationMessages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede exceder 255 caracteres.',
            'foto.image' => 'El archivo debe ser una imagen válida.',
            'foto.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o webp.',
            'foto.max' => 'La imagen no puede exceder 25MB. La imagen se comprimirá automáticamente después de subirla.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'dosis.string' => 'La dosis debe ser texto.',
            'dosis.max' => 'La dosis no puede exceder 255 caracteres.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'cultivo.string' => 'El cultivo debe ser texto.',
            'cultivo.max' => 'El cultivo no puede exceder 255 caracteres.',
            'etapa.string' => 'La etapa debe ser texto.',
            'etapa.max' => 'La etapa no puede exceder 255 caracteres.',
        ];
    }
}

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'precio' => 'required|numeric|min:0',
                'dosis' => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'cultivo' => 'required|string|max:255',
                'etapa' => 'required|string|max:255',
                'enabled' => 'nullable',
            ], $this->getValidationMessages());

            // Convertir enabled a boolean
            $validated['enabled'] = $this->convertToBoolean($request->input('enabled', true));
            
            // Asegurar que precio sea numérico
            $validated['precio'] = (float) $validated['precio'];

            if ($request->hasFile('foto')) {
                $validated['foto'] = $this->processImage($request->file('foto'));
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
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'precio' => 'required|numeric|min:0',
                'dosis' => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'cultivo' => 'required|string|max:255',
                'etapa' => 'required|string|max:255',
                'enabled' => 'nullable',
            ], $this->getValidationMessages());

            // Convertir enabled a boolean
            $validated['enabled'] = $this->convertToBoolean($request->input('enabled', $product->enabled));
            
            // Asegurar que precio sea numérico
            $validated['precio'] = (float) $validated['precio'];

            if ($request->hasFile('foto')) {
                // Eliminar foto anterior si existe
                if ($product->foto) {
                    Storage::disk('public')->delete($product->foto);
                }
                $validated['foto'] = $this->processImage($request->file('foto'));
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
     */
    private function processImage($file): string
    {
        try {
            // Verificar que GD esté disponible
            if (!extension_loaded('gd')) {
                throw new \Exception('GD extension no está disponible');
            }

            // Crear nombre único para la imagen
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $path = 'products/' . $filename;
            $fullPath = storage_path('app/public/' . $path);

            // Crear directorio si no existe
            $directory = dirname($fullPath);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Obtener información de la imagen
            $imageInfo = getimagesize($file->getRealPath());
            if ($imageInfo === false) {
                throw new \Exception('No se pudo leer la información de la imagen');
            }

            list($originalWidth, $originalHeight, $imageType) = $imageInfo;

            // Calcular nuevas dimensiones (máximo 1920px de ancho manteniendo proporción)
            $maxWidth = 1920;
            $newWidth = $originalWidth;
            $newHeight = $originalHeight;

            if ($originalWidth > $maxWidth) {
                $ratio = $maxWidth / $originalWidth;
                $newWidth = $maxWidth;
                $newHeight = (int)($originalHeight * $ratio);
            }

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

            // Preservar transparencia para PNG y GIF
            if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_GIF) {
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
                $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
                imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
            }

            // Redimensionar imagen
            imagecopyresampled(
                $newImage,
                $sourceImage,
                0, 0, 0, 0,
                $newWidth,
                $newHeight,
                $originalWidth,
                $originalHeight
            );

            // Guardar imagen optimizada según el tipo
            $saved = false;
            switch ($imageType) {
                case IMAGETYPE_JPEG:
                    $saved = imagejpeg($newImage, $fullPath, 85); // Calidad 85%
                    break;
                case IMAGETYPE_PNG:
                    // Para PNG, usar nivel de compresión (0-9, donde 9 es máxima compresión)
                    $saved = imagepng($newImage, $fullPath, 2); // Nivel 2 de compresión
                    break;
                case IMAGETYPE_GIF:
                    $saved = imagegif($newImage, $fullPath);
                    break;
                case IMAGETYPE_WEBP:
                    if (function_exists('imagewebp')) {
                        $saved = imagewebp($newImage, $fullPath, 85); // Calidad 85%
                    }
                    break;
            }

            // Liberar memoria
            imagedestroy($sourceImage);
            imagedestroy($newImage);

            if (!$saved) {
                throw new \Exception('No se pudo guardar la imagen optimizada');
            }

            return $path;
        } catch (\Exception $e) {
            // Si falla la optimización, guardar la imagen original
            \Log::error('Error al procesar imagen: ' . $e->getMessage());
            return $file->store('products', 'public');
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
            'foto.max' => 'La imagen no puede exceder 10MB.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'dosis.required' => 'La dosis es obligatoria.',
            'dosis.string' => 'La dosis debe ser texto.',
            'dosis.max' => 'La dosis no puede exceder 255 caracteres.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'cultivo.required' => 'El cultivo es obligatorio.',
            'cultivo.string' => 'El cultivo debe ser texto.',
            'cultivo.max' => 'El cultivo no puede exceder 255 caracteres.',
            'etapa.required' => 'La etapa es obligatoria.',
            'etapa.string' => 'La etapa debe ser texto.',
            'etapa.max' => 'La etapa no puede exceder 255 caracteres.',
        ];
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-admin {--email=admin@example.com} {--password=password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear usuario administrador';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');

        $user = User::where('email', $email)->first();

        if ($user) {
            $this->info("El usuario con email {$email} ya existe.");
            if ($this->confirm('¿Deseas actualizar la contraseña?')) {
                $user->password = Hash::make($password);
                $user->save();
                $this->info("Contraseña actualizada para {$email}");
            }
            return 0;
        }

        User::create([
            'name' => 'Administrador',
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Usuario administrador creado exitosamente:");
        $this->line("Email: {$email}");
        $this->line("Password: {$password}");

        return 0;
    }
}

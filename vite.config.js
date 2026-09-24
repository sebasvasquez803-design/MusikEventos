import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/js/app.js',
                'resources/js/passkeys.js',
                'resources/css/reserva.css',
                'resources/css/registroClientes.css',
                'resources/js/transicion.js',
                'resources/css/mas_info.css',
                'resources/css/admin.css',
<<<<<<< HEAD
                'resources/css/login.css',
                'resources/css/sesion_rep.css',

=======
                'resources/js/calendario-modal.js',
                'resources/css/carrito.css'
>>>>>>> b82b60268cd9c8a63b4b5c4a48514626cb4471e3
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                    optimizedFallbacks: false,
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});

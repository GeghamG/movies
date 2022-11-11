import reactRefresh from '@vitejs/plugin-react-refresh';

export default ({ command }) => ({
    server: {
        port: 3000
    },
    base: command === 'serve' ? '' : '/build/',
    publicDir: 'fake_dir_so_nothing_gets_copied',
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            input: 'resources/js/app.js',
        },
    },
    plugins: [
        reactRefresh(),
    ],
});

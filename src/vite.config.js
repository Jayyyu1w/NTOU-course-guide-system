import { resolve } from 'path'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

const root = resolve(__dirname, 'src')
const outDir = resolve(__dirname, 'dist')
// https://vitejs.dev/config/
export default defineConfig({
  root,
  plugins: [vue()],
  build: {
    outDir,
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: resolve(root, 'index.html'),
        all_course: resolve(root, 'all_course', 'index.html'),
        login: resolve(root, 'login', 'index.html'),
        bulletin: resolve(root, 'bulletin', 'bulletin.html'),
      },
    }
  }
})

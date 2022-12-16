import { resolve } from 'path'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

const root = resolve(__dirname, 'src')
const outDir = resolve(__dirname, 'dist')
// https://vitejs.dev/config/
export default defineConfig({
  base: './NTOU-course-guide-system/',
  root,
  plugins: [vue()],
  build: {
    outDir,
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: resolve(root, 'index.html'),
        all_course: resolve(root, 'all_course', 'all_course.html'),
        bulletin: resolve(root, 'bulletin', 'bulletin.html'),
        course_edit: resolve(root, 'course_edit', 'course_edit.html'),
        course_info: resolve(root, 'course_info', 'course_info.html'),
        login: resolve(root, 'login', 'login.html'),
      }
    }
  }
})

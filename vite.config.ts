import { defineConfig } from 'vite'

export default defineConfig({
  build: {
    outDir: 'dist',
    rollupOptions: {
      input: {
        main: './index.html',
        teaching: './teaching.html',
        posterswithpurpose: './posters-with-purpose.html'
      }
    }
  },
  publicDir: 'public'
})

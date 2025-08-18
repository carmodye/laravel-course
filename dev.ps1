# dev.ps1
Write-Host "🧹 Cleaning public/build..."
Remove-Item -Recurse -Force "public/build" -ErrorAction SilentlyContinue

Write-Host "🚀 Starting Vite dev server..."
npm run dev

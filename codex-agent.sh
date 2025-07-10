#!/bin/bash

REPO_URL="https://github.com/hardnumber/cyber-tech-theme"
WORKDIR="$HOME/codex-theme-temp"
ZIP_PATH="$WORKDIR/theme.zip"

mkdir -p "$WORKDIR"
rm -rf "$WORKDIR"/*

echo "📦 جاري تحميل القالب من GitHub: $REPO_URL"

curl -s -L "$REPO_URL/archive/refs/heads/main.zip" -o "$ZIP_PATH"

if [[ ! -s "$ZIP_PATH" ]]; then
  echo "❌ فشل في تحميل الريبو. تأكد أن المستودع عام أو عندك وصول SSH."
  exit 1
fi

echo "✅ تم التحميل، جاري فك الضغط..."
unzip -q "$ZIP_PATH" -d "$WORKDIR/extracted"

THEME_DIR=$(find "$WORKDIR/extracted" -maxdepth 1 -type d -name "*cyber-tech-theme*")

if [[ ! -d "$THEME_DIR" ]]; then
  echo "❌ لم يتم العثور على مجلد القالب بعد فك الضغط."
  exit 2
fi

echo -e "📁 ملفات القالب الرئيسية في: $THEME_DIR\n"
ls "$THEME_DIR" | grep -E "functions.php|style.css|index.php|footer.php|header.php"

echo -e "\n🧠 جاهز لتحليله أو تشغيل Codex عليه من المسار:"
echo "$THEME_DIR"

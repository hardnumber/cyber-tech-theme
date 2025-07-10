#!/bin/bash

# المسار الحالي
THEME_PATH="$(pwd)"
REPORT_PATH="$THEME_PATH/analysis_report.txt"

# التحقق من وجود ملفات أساسية
REQUIRED_FILES=("functions.php" "index.php" "style.css")
echo "🔍 جاري فحص القالب في: $THEME_PATH" > "$REPORT_PATH"

for file in "${REQUIRED_FILES[@]}"; do
    if [ ! -f "$THEME_PATH/$file" ]; then
        echo "❌ الملف $file غير موجود!" >> "$REPORT_PATH"
    else
        echo "✅ الملف موجود: $file" >> "$REPORT_PATH"
        echo "------------------------------------" >> "$REPORT_PATH"
        head -n 30 "$THEME_PATH/$file" >> "$REPORT_PATH"
        echo -e "\n" >> "$REPORT_PATH"
    fi
done

echo -e "\n📄 تم إنشاء تقرير مبدأي في: $REPORT_PATH"
echo -e "🔁 يمكنك الآن إرسال هذا التقرير إلى Codex أو أي AI Agent لتحسين القالب.\n"

# برومبت ذكي يمكن نسخه وإرساله مباشرة لأي نموذج AI:
echo "🔧 برومبت مقترح لتحسين القالب:"
cat <<EOF

🛠️ أنت خبير WordPress.
افحص الملفات التالية الموجودة في مجلد القالب:

📂 المسار: $THEME_PATH
- functions.php
- index.php
- style.css

المطلوب:
1. اكتشاف المشاكل البرمجية أو الأمنية.
2. تحسين الأداء وتنظيم الكود.
3. التوافق مع معايير WordPress الرسمية.
4. اقتراح تغييرات تقنية، وإن أمكن، توليد النسخة المحسّنة.

EOF

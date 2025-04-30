#!/bin/bash

# Run npm build
npm run build

# Generate a hashed style.css file
HASH=$(md5 -q ./style.css) # Generate a hash for the style.css file
HASHED_FILE="style.$HASH.css"

# Rename the style.css file with the hash
cp ./style.css "./$HASHED_FILE"

# Update header.php with the new hashed file name
HEADER_FILE="./header.php"
sed -i '' "s|/style\.css|/$HASHED_FILE|g" "$HEADER_FILE"

OUTPUT_ZIP="minhhy.fun.zip"

zip -r "$OUTPUT_ZIP" . \
  -x "./.git/*" \
  -x "./.gitignore" \
  -x "./node_modules/*" \
  -x "./src/*" \
  -x "./build.sh" \
  -x "./README.md" \
  -x "./package.json" \
  -x "./package-lock.json" \
  -x "./main.css" \
  -x "LICENSE"

echo "Project zipped to $OUTPUT_ZIP"
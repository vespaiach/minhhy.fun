#!/bin/bash

OUTPUT_ZIP="minhhy.zip"

zip -r "$OUTPUT_ZIP" . \
  -x ".git/*" \
  -x "./node_modules/*" \
  -x "./src/*" \
  -x "./pack.sh" \
  -x "*.mp4"

echo "Project zipped to $OUTPUT_ZIP"
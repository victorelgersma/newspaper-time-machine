#!/bin/bash

# Usage: ./process.sh <input_image_file_or_directory>

# Step 1: Get the input
input_path="$1"

# Step 2: Check if the input is a directory or a file
if [ -d "$input_path" ]; then
    # If it's a directory, process all .png files inside it
    echo "Input is a directory. Processing all .png files..."
    
    # Loop over each .png file in the directory
    for input_file in "$input_path"/*.png; do
        if [ -f "$input_file" ]; then
            echo "Processing file: $input_file"
            
            # Step 3: Get the directory of the input image
            input_dir=$(dirname "$input_file")

            # Step 4: Get the base filename without the extension
            base_filename=$(basename "$input_file" .png)

            # Step 5: Define the output text directory (same structure as img/, but under text/)
            output_dir="text/${input_dir#./img/}"  # Removes './img/' and keeps the same structure under 'text/'
            mkdir -p "$output_dir"  # Create the directory for the processed text if it doesn't exist

            # Step 6: Run Tesseract OCR on the input image, saving output to a temporary file
            tesseract "$input_file" tmp  # This generates tmp.txt

            # Step 7: Run Python post-processing script to fix common OCR errors and save final output
            python3 post_processing.py tmp.txt > "$output_dir/$base_filename.txt"  # Use relative path to src

            # Remove the temporary text file
            rm tmp.txt

            echo "Processing complete. Output saved to $output_dir/$base_filename.txt"
        fi
    done
elif [ -f "$input_path" ]; then
    # If it's a file, process that specific file
    echo "Input is a file. Processing: $input_path"

    # Step 3: Get the directory of the input image
    input_dir=$(dirname "$input_path")

    # Step 4: Get the base filename without the extension
    base_filename=$(basename "$input_path" .png)

    # Step 5: Define the output text directory (same structure as img/, but under text/)
    output_dir="text/${input_dir#./img/}"  # Removes './img/' and keeps the same structure under 'text/'
    mkdir -p "$output_dir"  # Create the directory for the processed text if it doesn't exist

    # Step 6: Run Tesseract OCR on the input image, saving output to a temporary file
    tesseract "$input_path" tmp  # This generates tmp.txt

    # Step 7: Run Python post-processing script to fix common OCR errors and save final output
    python3 post_processing.py tmp.txt > "$output_dir/$base_filename.txt"  # Use relative path to src

    # Remove the temporary text file
    rm tmp.txt

    echo "Processing complete. Output saved to $output_dir/$base_filename.txt"
else
    echo "Error: $input_path is neither a valid file nor a directory."
fi
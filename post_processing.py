import sys
import json
import os

# Change the working directory to the script's directory
script_dir = os.path.dirname(os.path.realpath(__file__))
os.chdir(script_dir)

# Load the word correction pairs from the corrections.txt file
def load_corrections(corrections_file):
    corrections = {}
    with open(corrections_file, 'r') as file:
        for line in file:
            # Ignore empty lines and lines that don't have exactly two words
            line = line.strip()
            if not line or len(line.split()) != 2:
                continue
            incorrect, correct = line.split()
            corrections[incorrect] = correct
    return corrections

# Load the corrections by filename from the corrections2.json file
def load_filename_specific_corrections(corrections_file):
    with open(corrections_file, 'r') as file:
        return json.load(file)

# Remove unwanted strings (we'll define a list of strings to remove)
def remove_unwanted_strings(text):
    unwanted_strings = [
        "© "  # Remove unwanted characters like copyright symbols, etc.
    ]
    for unwanted in unwanted_strings:
        text = text.replace(unwanted, '')
    return text

# Read OCR output from file
with open(sys.argv[1], 'r') as file:
    content = file.read()

# Step 0: Remove line-break hyphens
import re
content = re.sub(r'-\s*\n\s*', '', content)

# Step 1: Remove unwanted strings
content = remove_unwanted_strings(content)

# Step 2: Load the single-word correction list (you can adjust the file path as needed)
corrections = load_corrections('corrections.txt')

# Step 3: Load the filename-specific correction rules (from corrections2.json)
filename_corrections = load_filename_specific_corrections('corrections2.json')

# Step 4: Get the filename of the input image (without the extension)
input_filename = sys.argv[1]
filename_base = input_filename.split('/')[-1].split('.')[0]  # Get just the base filename without extension

# Step 5: Apply the "global" corrections universally (always)
if "global" in filename_corrections:
    global_corrections = filename_corrections["global"]
    for incorrect, correct in global_corrections.items():
        if isinstance(correct, str):  # Ensure the correction is a string
            content = content.replace(incorrect, correct)
        else:
            print(f"Skipping invalid correction for '{incorrect}': {correct}")

# Step 6: Apply the corrections based on the specific filename match
applied_corrections = []
for key, corrections_dict in filename_corrections.items():
    if key != "global" and key in filename_base:  # Skip "global" and check for filename match
        applied_corrections.append(key)
        # Apply the corrections in this section
        for incorrect, correct in corrections_dict.items():
            if isinstance(correct, str):  # Ensure the correction is a string
                content = content.replace(incorrect, correct)
            else:
                print(f"Skipping invalid correction for '{incorrect}': {correct}")

# Step 7: Apply the single-word corrections (from corrections.txt)
for incorrect, correct in corrections.items():
    content = content.replace(incorrect, correct)

# Step 8: Save corrected output to stdout (this will go to the output.txt file in the shell script)
print(content)

# Optional: Print which filename-specific corrections were applied for debugging
if applied_corrections:
    print(f"Corrections applied for the following filenames: {', '.join(applied_corrections)}")
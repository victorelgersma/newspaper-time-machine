# newspaper-time-machine

https://britishnewspaperarchive.co.uk/viewer/bl/0000060/18450804/021/0004

Turn all the images into text at img/text/1844/mercury similarly named: 

```
./process /img/1844/mercury
```

Process runs tesseract and the post_processing.py script which simply does some common word replacements. 

Remove hyphenation marks at the end of lines:

```
./dehyphenate /img/1844/mercury/Screenshot 2026-03-22 at 17.20.24.txt
```

concatenate all text files under mercury.txt into a merged.txt

```
./merge /img/1844/mercury
```

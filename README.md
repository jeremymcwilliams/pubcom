
Code base for the Lewis & Clark Publications & Communications department's digital image library migration from Aperture to Omeka.

For a given export directory of images and metadata, the code does the following:

1) Creates Omeka-ready collection specific csv-files
2) Uses ImageMagick to create web appropriate jpegs from master Tiffs or NEFs
3) Possibly FTPs images to appropriate spots


Uses the following:
-exiftool
-imagemagick
-html5 boilerplate

Requires symbolic link to Desktop set in your local code directory

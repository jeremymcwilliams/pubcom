
Code base for the Lewis & Clark Publications & Communications department's digital image library migration from Aperture to Omeka.

For a given export directory of images and metadata, the code does the following:

1) Creates Omeka-ready collection specific csv-files
2) Uses ImageMagick to create web appropriate jpegs from master Tiffs or NEFs
3) Possibly FTPs images to appropriate spots


Uses the following:
-exiftool
-imagemagick
-html5 boilerplate


Some Requirements:
1) Symbolic link to Desktop set in your local code directory
-this may require un-doing and re-doing the symbolic link on a local computer
-in terminal, navigate to /Library/WebServer/Documents/pubcom/ and do the following:
rm Desktop
ln -s /Users/{username}/Desktop Desktop
(replacing {username} with your real username)

2) A writable directory on your Desktop called "OmekaCSVfiles"

3) A writable directory on your Desktop called "converted"
# COMPSCI-6WW3-Projects
McMaster University COMPSCI 6WW3: Web Applications and Web Systems Course Projects

Baran Kaya, 400284996
COMPSCI 6WW3

-----------------------------------
Project 1 Add-on task 2 questions:

i. I have 2 different size logos for my project. One of them is 100x100px and the other 
one is 200x200px. Picture tag uses <source> and <img> tags. Source tags can be used for 
different size condition. For example:

<picture id="websiteLogo">
	<source media="(min-width: 800px)" id="websiteLogoBig"
        	srcset="../Images/Logo.png">
	<img src="../Images/LogoSmall.png" alt="ParkRater Logo"
        	id="websiteLogoSmall">
</picture>

- In this code I used 200x200 logo for bigger than 800px devices. It doesn't have to be only 
2 versions of images. We can use more than 2. For example, if I want to use any other version 
of my logo for 500px to 800px devices I can add another source tag for it.
- Finally if non of the source tags comply the media contidions of any of the source tags 
then picture tag uses <img> tags image. In this code if the device screen is smaller than the 
800px, it uses <img> tags logo which is the 100x100px version of it.

-----

ii.
1) We can use better resolution pictures for bigger screens.
2) Since low res. screens use low res. images, mobile devices use less connection for images.
3) Browser selects best image for device resolution without using any css code.

-----

iii. If we use static measurements for different images, we have to adjust their size 
individualy to fit perfectly. But we can overcome this by using dynamic measurments. Or 
we have to give every source and img tag different id and adjust their size individually.


-----------------------------------

In Project 1 I used (unsplash.com) for free open source images.

Also I designed site logo on (freelogodesign.org).

For image resizing: (resizeimage.net)

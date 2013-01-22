###
# Author : Ruben Gonzalez ( rubenrua@uvigo.es )
# Created On : Wed May 13 10:04:53 UTC 2009
# Coje todas las imagenes de la carpeta ./pics
# y le pone de pie la imagen guardade en pie, la cual
# por defecto tiene 300 x 50 px

import sys, os, Image

pie = '/var/www2/pumukituvigo/batch/itunes/generate_pic/faldon.png'

def imconcat(file_in):
    im1 = Image.open(file_in)
    im2 = Image.open(pie)
    w1, h1 = im1.size
    w2, h2 = im2.size
    if (w1 < 190):
        print "\t - " + file_in + " OJO imagen Muy pequena."
    if (w1 != 300): 
        h1 = 300 * h1 / w1
        w1 = 300
        im1 = im1.resize((w1, h1))
    if (h1 > 210):
        im1 = im1.crop((0, 10 , w1, h1 - 20))
        h1 = h1 - 30
    print im1.size, w1, h1
    im3 = Image.new("RGB", (max(w1, w2), h1 + h2), "#ffffff")
    im3.paste(im1, (0, 0, w1, h1))
    im3.paste(im2, (0, h1))
    out = "./picsconpie/" + os.path.basename(file_in)
    im3.save(out)
    return im3


if __name__ == '__main__':
    for pic in os.listdir("pics/"):
        print pic
        imconcat("pics/" + pic)



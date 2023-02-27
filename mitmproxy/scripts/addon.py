from urllib.parse import unquote
from mitmproxy import http
import time
import os
import io
from PIL import Image
import numpy as np
import math


def response(flow: http.HTTPFlow):
    if flow.response.headers.get("content-type", "").endswith(('jpg', 'jpeg')):
        domain, port = flow.server_conn.address

        if not os.path.exists("/home/images/%s" % domain):
            os.mkdir("/home/images/%s" % domain)

        if not os.path.exists("/home/images/%s/%d" % (domain, port)):
            os.mkdir("/home/images/%s/%d" % (domain, port))

        filename = unquote(flow.request.path).split('/')[-1].split('?')[0]

        # append filetype to filename if it doesn't have one
        if filename.find('.') == -1:
            if flow.response.headers.get("content-type", "").endswith('jpg'):
                filename += '.jpg'
            elif flow.response.headers.get("content-type", "").endswith('jpeg'):
                filename += '.jpeg'

        # add timestamp to filename
        filename = str(int(time.time())) + '_' + filename
        img = Image.open(io.BytesIO(flow.response.content))
        width, height = img.size
        lsbVar = 0
        for y in range(0, height):
            for x in range(0, width):
                r, g, b = img.getpixel((x, y))
                for i in img.getpixel((x, y)):
                    lsbVar += i % 2
        lsbVar /= (width * height * 3)
        print("This image is probably encrypted", lsbVar)
        print(Spam(img))
        open("/home/images/%s/%d/%s" %
             (domain, port, filename), "wb").write(flow.response.content)
        flow.response.headers["content-type"] = "image/jpeg"


def Spam(image):
    height, width = image.size
    picture = np.reshape(image.getdata(), (height, width, 3))
    last = picture[0][0]
    order = 3
    orderList = [picture]
    for i in range(order):
        horizArray = []
        last = orderList[-1][0][0]
        for y in orderList[-1]:
            horizArray.append([])
            for x in y:
                horizArray[-1].append(last - x)
                last = x
        orderList.append(horizArray)

    orderVert = [np.rot90(picture)]
    for i in range(order):
        vertArray = []
        last = orderList[-1][0][0]
        for y in orderList[-1]:
            horizArray.append([])
            for x in y:
                horizArray[-1].append(last - x)
                last = x
        orderList.append(horizArray)

    # var1 = math.floor(np.average([np.var(x) for x in orderList[1]]))
    # var2 = math.floor(np.average([np.var(x) for x in orderList[2]]))
    print("Variance:",  [np.average([np.var(x) for x in horizArray]) for horizArray in orderList], [
          np.average([np.var(x) for x in vertArray]) for vertArray in orderVert])
    return 1

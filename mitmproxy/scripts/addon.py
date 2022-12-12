from mitmproxy import http
import os
import time

def response(flow: http.HTTPFlow):
    if flow.response.headers.get("content-type", "").endswith(('jpg', 'jpeg')):
        domain, port = flow.server_conn.address

        if not os.path.exists("/home/images/%s"%domain):
            os.mkdir("/home/images/%s"%domain)

        if not os.path.exists("/home/images/%s/%s"%(domain,str(port))):
            os.mkdir("/home/images/%s/%s"%(domain,str(port)))
        filename = flow.request.path.split('/')[-1].split('?')[0]
        ## append filetype to filename if it doesn't have one
        if filename.find('.') == -1:
            if flow.response.headers.get("content-type", "").endswith('jpg'):
                filename += '.jpg'
            elif flow.response.headers.get("content-type", "").endswith('jpeg'):
                filename += '.jpeg'

        # add timestamp to filename
        filename = str(int(time.time())) + '_' + filename
        
        open("/home/images/%s/%d/%s"%(domain,port,filename), "wb").write(flow.response.content)
        flow.response.headers["content-type"] = "image/jpeg"

from mitmproxy import http
import os


def response(flow: http.HTTPFlow):
    if flow.response.headers.get("content-type", "").endswith(('jpg', 'jpeg')):
        domain, port = flow.server_conn.address

        if not os.path.exists("/home/images/" + domain):
            os.mkdir("/home/images/" + domain)

        if not os.path.exists("/home/images/" + domain + "/" + str(port)):
            os.mkdir("/home/images/" + domain + "/" + str(port))
        filename = flow.request.path.split('/')[-1].split('?')[0]
        open("/home/images/" + domain + "/" + str(port) + "/" +
             filename, "wb").write(flow.response.content)
        oldimg = flow.response.content
        flow.response.headers["content-type"] = "image/jpeg"

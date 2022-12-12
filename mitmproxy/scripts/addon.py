from mitmproxy import http


def response(flow: http.HTTPFlow):
    if flow.response.headers.get("content-type", "").startswith("image"):
        img = open("test.jpeg", "rb").read()
        open("images/" + flow.request.path.split('/')
             [-1], "wb").write(flow.response.content)
        oldimg = flow.response.content
        print('title:', flow.request.path.split('/')[-1])
        # flow.response.content = img
        flow.response.headers["content-type"] = "image/jpeg"

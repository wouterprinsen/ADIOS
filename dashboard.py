from flask import Flask, request, render_template_string
app = Flask(__name__)

#===========================================================================
@app.route("/opdracht1")
def opdracht1():
    # get the docker library
    import docker
    client = docker.from_env()
    
    image_names = [img.tags[0] for img in client.images.list()]
    
    dropdown_options = ''.join([f'<option value="{name}">{name}</option>' for name in image_names])
    
    html_template = """
    <form action="/dashboard.php">
        <label for="images">Choose an image:</label>
        <select id="images" name="images">
            {{ dropdown_options }}
        </select><br><br>
        <input type="submit">
    </form>
    """
    
    rendered_template = render_template_string(html_template, dropdown_options=dropdown_options)
    
    return rendered_template

if __name__ == "__main__":
    app.run(host='10.3.12.20', port=5000)

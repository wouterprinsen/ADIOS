import docker
from flask import Flask, jsonify, request

app = Flask(__name__)
client = docker.from_env()

@app.route('/start_container/<img>', methods=['GET', 'POST'])
def combined(img):
        try:
            print("Starting container with image:", img)
            container = client.containers.run(img, detach=True, name='container', command='sleep 1d')
            return f'Container based on {img} started successfully!'
        except docker.errors.ImageNotFound:
            return 'Image not found', 404
        except docker.errors.APIError as e:
            return f'Error occurred: {e}', 500
if __name__ == "__main__":
    app.run(host='0.0.0.0')

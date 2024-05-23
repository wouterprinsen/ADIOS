from flask import Flask, jsonify, request
import docker
from flask_cors import CORS

app = Flask(__name__)
CORS(app)  # Enable CORS for all routes
client = docker.from_env()

@app.route('/images', methods=['GET'])
def list_images():
    try:
        result = subprocess.run(['docker', 'images', '--format', '{{.Repository}}:{{.Tag}}'], capture_output=True, text=True)
        images = result.stdout.strip().split('\n')
        image_list = [{'id': image, 'tags': [image]} for image in images]
        return jsonify(image_list)
    except Exception as e:
        return jsonify({'error': str(e)}), 500

@app.route('/create_container', methods=['POST'])
def create_container():
    data = request.json
    image_name = data.get('image_name')
    if image_name:
        try:
            container = client.containers.run(image_name, detach=True)
            return jsonify({'container_id': container.id}), 201
        except Exception as e:
            return jsonify({'error': str(e)}), 500
    else:
        return jsonify({'error': 'Image name is required'}), 400

if __name__ == '__main__':
    app.run(host='0.0.0.0')

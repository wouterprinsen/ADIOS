from flask import Flask, jsonify, request
import subprocess  # For executing shell commands
import docker

app = Flask(__name__)

# Manually set CORS headers
@app.after_request
def add_cors_headers(response):
    response.headers['Access-Control-Allow-Origin'] = '*'
    response.headers['Access-Control-Allow-Headers'] = 'Content-Type'
    response.headers['Access-Control-Allow-Methods'] = 'GET, POST, OPTIONS'
    return response

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

@app.route('/option1', methods=['POST'])
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

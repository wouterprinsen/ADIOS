from  flask import Flask, request, jsonify
app=Flask(__name__)

import docker
def start_ubuntu_container():
    try:
        client = docker.from_env()
        container = client.containers.run('ubuntu', detach=True, name='ubu01', command='sleep 1d')
        return container
    except docker.errors.APIError as e:
        print(f"Error occurred: {e}")
        return None


@app.route('/option1', methods=['GET', 'POST'])
def handle_button_click():
    container = start_ubuntu_container()
    if container:
        return 'Ubuntu container started successfully!'
    else:
        return 'Failed to start Ubuntu container.'

app.run(host='0.0.0.0') #luister naar al zijn IP-adressen

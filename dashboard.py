from  flask import Flask
app=Flask(__name__)

#als de url geen enkele functie aanroept, pakt hij deze
@app.route("/")
def hello():
  return "dashboard"

@app.route("/NL")
def helloNL():
  return "dashboard"
  
#===========================================================================  
@app.route("/opdracht1", methods=["GET","POST"])
def opdracht1():
#get the docker library
#-------------------------
  import docker
  client=docker.from_env()
#-------------------------
#loop door alle images
  for img in client.images.list():
    if request.method == "GET":
      img = request.form['imagelijst']
      
  #print (OUTPUTHTML1)
  #return OUTPUTHTML1
#===========================================================================  
#===========================================================================  
#hier moet nog wat gefixt worden!
@app.route("/opdracht2")
def opdracht2():
#get the docker library
#-------------------------
  import docker
  client=docker.from_env()
#-------------------------
  OUTPUTHTML2="<table class='tabelopdracht1'>" \
                               + "<tr><th>ID</th><th>Name</th><th>State</th></tr>"
#loop door alle images
  for container in client.containers.list(all=True):
    OUTPUTHTML2=OUTPUTHTML2+"<tr>"  \
                                 + "<td>"+container.short_id+"</td>" \
                                 + "<td>"+container.name+"</td>" \
                                 + "<td>"+container.status+"</td>" \
                                 +"</tr>"

  OUTPUTHTML2=OUTPUTHTML2+"</table>"
  #print (OUTPUTHTML2)
  return OUTPUTHTML2
#===========================================================================  
#===========================================================================  
@app.route("/opdracht3")
def opdracht3():
#get the docker library
#-------------------------
  import docker
  client=docker.from_env()
#-------------------------
  containers = client.containers.list()

  OUTPUTHTML3 = "<div>Searching running containers..."

  if not containers:
      OUTPUTHTML3=OUTPUTHTML3+"<div>" \
                                    + "<p>No containers available</p>" \
                                    +"</div>"
  elif containers:
    for container in containers:
        if container.name != "dashboard":
              OUTPUTHTML3=OUTPUTHTML3+"<div>" \
                                           + "<p>Stopping container:"+container.name+"</p>" \
                                           + "<p>Stopped container:"+container.name+"</p>" \
                                           +"</div>"
              container.stop()

  OUTPUTHTML3=OUTPUTHTML3+"</div>"

  return OUTPUTHTML3
#===========================================================================  
#===========================================================================  
@app.route("/opdracht4")
def opdracht4():
#get the docker library
#-------------------------
  import docker
  client=docker.from_env()
#-------------------------
  stopped_containers = [container for container in client.containers.list(all=True) if container.status != 'running']

  OUTPUTHTML4 = "<div>Searching stopped containers..."
  if stopped_containers:
    for container in stopped_containers:
        OUTPUTHTML4=OUTPUTHTML4+"<div>" \
                                     + "<p>Removing container:"+container.name+"</p>" \
                                     + "<p>Removed container:"+container.name+"</p>" \
                                     +"</div>"
        container.remove()
  elif not stopped_containers:
      OUTPUTHTML4=OUTPUTHTML4+"<div>" \
                                   + "<p>No containers available</p>" \
                                   +"</div>"

  OUTPUTHTML4=OUTPUTHTML4+"</div>"

  return OUTPUTHTML4
#===========================================================================  
#===========================================================================  
@app.route("/opdracht5")
def opdracht5():
#get the docker library
#-------------------------
  import sys
  import docker
  client=docker.from_env()
#-------------------------
  OUTPUTHTML5="<div>Executing start command..."

  container = client.containers.run(image='ubuntu',command='sleep 1d',name='ubu01',detach=True)
  OUTPUTHTML5=OUTPUTHTML5+"<div>" \
                               + "<p>Starting container...</p>" \
                               + "<p>Started container:"+container.name+"</p>" \
                               +"</div>"

  OUTPUTHTML5=OUTPUTHTML5+ "</div>"

  return OUTPUTHTML5
#===========================================================================  
#===========================================================================  
@app.route("/opdracht6/<containernaam>", methods=["GET","POST"])
def opdracht6(containernaam):
#get the docker library
#-------------------------
  import sys
  from flask import Flask, request
  import docker
  app=Flask(__name__)
  client=docker.from_env()
#-------------------------
  OUTPUTHTML6 = "<div>Searching running containers..."
  
  if request.method == "POST":
      containernaam = request.form['txt_container']

  try:
      container = client.containers.get(containernaam)
      container.stop()
      container.remove()
      return f"Container {containernaam} successfully removed"
  except docker.errors.NotFound:
      return f"Container {containernaam} not found"

  OUTPUTHTML6=OUTPUTHTML6+"</div>"
  return OUTPUTHTML6
#===========================================================================  
#===========================================================================  
@app.route("/opdracht7/<inm>/<sc>/<hv>/<cv>/<hp>/<cp>/<cn>", methods=["GET","POST"])
def opdracht7(inm,sc,hv,cv,hp,cp,cn):
#get the docker library
#-------------------------
  import sys
  from flask import Flask, request
  import docker
  app = Flask(__name__)
  client=docker.from_env()
#-------------------------
  #OUTPUTHTML7="<div>Executing start command..."
  if request.method == "POST":
      inm = request.form['txt_imagenaam']
      sc = request.form['txt_commando']
      hv = request.form['txt_hostvolume']
      cv = request.form['txt_containervolume']
      hp = request.form['txt_hostpoort']
      cp = request.form['txt_containerpoort']
      cn = request.form['txt_containernaam']

  inm2 = inm.replace('-', '/')
  sc2 = sc.replace('-', ' ')
  hv2 = hv.replace('-', '/')
  cv2 = cv.replace('-', '/')

  config = {
          "image": inm2,
          **({"command": sc2} if sc2 != 'none' else {}),
          **({"volumes": {hv2: {"bind": cv2, "mode": "rw"}}} if hv2 and cv2 != 'none' else {}),
          **({"ports": {hp:cp}} if hp and cp != 'none' else {}),
          **({"name": cn} if cn != 'none' else {}),
  }
  try:
      client.containers.run(**config)
      return f"Container {cn} is succesfully running"
  except docker.errors.DockerException as e:
      return f"Container {cn} failed to start: {e}"
  
  #OUTPUTHTML7=OUTPUTHTML7+"</div>"
  #return OUTPUTHTML7
#===========================================================================  
#===========================================================================  
@app.route("/opdracht8/<usr>/<pwd>/<inm>/<tag>/<rep>", methods=["GET","POST"])
def opdracht8(usr,pwd,inm,tag,rep):
#get the docker library
#-------------------------
  import sys
  from flask import Flask, request
  import docker
  import os.path
  app = Flask(__name__)
  client=docker.from_env()
#-------------------------
  #OUTPUTHTML8=
  if request.method == "POST":
      usr = request.form['txt_username']
      pwd = request.form['password']
      rep = request.form['txt_repository']
      inm = request.form['txt_image']
      tag = request.form['txt_tag']

  try:
      rep2 = rep.replace('-', '/')
      client.login(username=usr,password=pwd)

      image = client.images.get(inm)
      image.tag(rep2, tag=tag)

      upload = f"{rep}/{inm}"

      for line in client.images.push(upload, tag=tag, stream=True, decode=True):
          print(line)
      return f"Image {inm} succesfully pushed to repository {rep}"
  except docker.errors.DockerException as e:
      return f"Image {inm} failed to push: {e}"

  #OUTPUTHTML8=OUTPUTHTML8+"</div>"
  #return OUTPUTHTML8
#===========================================================================
#===========================================================================
@app.route("/opdracht9/<containernaam>", methods=["GET","POST"])
def opdracht9(containernaam):
#get the docker library
#-------------------------
  import sys
  from flask import Flask, request
  import docker
  app=Flask(__name__)
  client=docker.from_env()
#-------------------------
  if request.method == "POST":
      containernaam = request.form['cont_prestatie']

  try:
      container = client.containers.get(containernaam)
      stats = container.stats(decode=None, stream=False)

      cpu_stats = stats['cpu_stats']
      cpu_usage = cpu_stats['cpu_usage']['total_usage']

      memory_stats = stats['memory_stats']
      memory_usage = memory_stats['usage']

      return f"Container statistics: CPU: {cpu_usage}, RAM: {memory_usage}"
  except docker.errors.NotFound:
      return f"Container {containernaam} not found"

  #print (OUTPUTHTML9)
  #return OUTPUTHTML9
#===========================================================================
#app.run(debug=True) dan alleen  via 127.0.0.1 te benaderen
iapp.run(host='0.0.0.0') #luister naar al zijn IP-adressen

from flask import Flask, jsonify, abort
from flask_httpauth import HTTPBasicAuth
import json
import os

app = Flask(__name__)
auth = HTTPBasicAuth()

users = {
    "toto": "python"
}

@auth.verify_password
def verify_password(username, password):
    if username in users and users[username] == password:
        return username

@app.route('/pozos/api/v1.0/get_student_ages', methods=['GET'])
@auth.login_required
def get_student_ages():
    # Chemin vers le fichier JSON
    json_path = '/data/student_age.json'
    
    # Vérifier si le fichier existe
    if not os.path.exists(json_path):
        abort(404, description="Student data file not found")
    
    try:
        # Lire et parser le fichier JSON
        with open(json_path, 'r') as f:
            student_data = json.load(f)
        
        return jsonify(student_data)
    
    except json.JSONDecodeError:
        abort(500, description="Error parsing student data")
    except Exception as e:
        abort(500, description=f"Server error: {str(e)}")

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
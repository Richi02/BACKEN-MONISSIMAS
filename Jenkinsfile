pipeline {
    agent any

    stages {
        
        stage('Preparacion'){
            steps {
                git branch:'master',url:'https://github.com/Richi02/BACKEN-MONISSIMAS.git'
   	       		echo 'Pulled from github successfully'
            }
        }
        
        stage('Verifica version php'){
            steps {
                sh 'php --version'
            }
        }

        stage('Docker Build') {
            steps {
                sh 'docker build -t backen-monissimas .'
            }
        }

         stage('Deploy php') {
            steps {
                sh 'docker compose up -d'
            }
        }
       
    }
}

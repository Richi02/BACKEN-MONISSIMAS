pipeline {
    agent any

    stages {
        
        stage('Preparacion'){
            steps {
                git 'git@github.com:Richi02/BACKEN-MONISSIMAS.git'
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
                sh 'docker build -t BACKEN-MONISSIMAS .'
            }
        }

         stage('Deploy php') {
            steps {
                sh 'docker compose up -d'
            }
        }
       
    }
}

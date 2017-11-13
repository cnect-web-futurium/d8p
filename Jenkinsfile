pipeline {
    agent none
    stages {
        stage('Provisioning') {
            steps {
                ec2 cloud: 'EC2 Cloud', template: 'JenkinsSlave'
                sleep time: 8, unit: 'MINUTES'
            }
            node('JenkinsSlave') {
                stage('Build') {
                    steps {
                        sh '''cd /home/ubuntu/workspace/ &&
                        git clone -b develop https://github.com/cnect-web/d8p.git &&
                        cd d8p/ &&
                        composer install &&
                        ./bin/robo project:install -o "project.root: /home/ubuntu/workspace/d8p" -o "database.password: cnect" &&
                        ./bin/robo project:setup-behat -o "project.root: /home/ubuntu/workspace/d8p" -o "database.password: cnect"
                        '''
                    }
                }
                stage('Install') {
                    steps {
                        sh '''sudo ln -s /home/ubuntu/workspace/d8p/web /var/www/html/ &&
                        sudo chmod 0777 /home/ubuntu/workspace/d8p/web/sites/default/files/
                        '''
                    }
                }
                stage('Test') {
                    steps {
                        sh '''cd /home/ubuntu/workspace/d8p/tests &&
                        ./behat
                        '''
                    }
                }
            }
        }
    }
}

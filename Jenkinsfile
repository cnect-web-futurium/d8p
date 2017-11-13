node('JenkinsSlave') {
    stage('Build') {
        sh '''
            cd /home/ubuntu/workspace/ &&
            git clone -b develop https://github.com/cnect-web/d8p.git &&
            cd d8p/ &&
            composer install &&
            ./bin/robo project:install -o "project.root: /home/ubuntu/workspace/d8p" -o "database.password: cnect" &&
            ./bin/robo project:setup-behat -o "project.root: /home/ubuntu/workspace/d8p" -o "database.password: cnect"
            '''
    }
    stage('Install') {
        sh '''
            sudo ln -s /home/ubuntu/workspace/d8p/web /var/www/html/ &&
            sudo chmod 0777 /home/ubuntu/workspace/d8p/web/sites/default/files/
            '''
    }
    stage('Test') {
        sh '''cd /home/ubuntu/workspace/d8p/tests &&
        ./behat
        '''
    }
}

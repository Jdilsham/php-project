pipeline{
    agent any

    options {
        timestamps()
        disableConcurrentBuilds()
        buildDiscarder(logRotator(numToKeepStr: '20'))
    }

    parameters{
        string(
            name: 'IMAGE_TAG',
            description: 'Docker image tag to deploy (from GitHub Actions)'
        )
    }
    
    environment {
        DOCKERHUB_USER	=	credentials('dockerhub-username')
		IMAGE_NAME		=	credentials('dockerhub-php-image-name')
		AWS_ACCESS_KEY_ID     = credentials('aws-access-key-id')
        AWS_SECRET_ACCESS_KEY = credentials('aws-secret-access-key')
        AWS_DEFAULT_REGION    = credentials('aws-region')

        EKS_CLUSTER      = credentials('eks-cluster-name')
        K8S_NAMESPACE    = credentials('k8s-php-namespace')

        NEW_IMAGE = "${DOCKERHUB_USER}/${IMAGE_NAME}:${IMAGE_TAG}"
    }

    stages{
        stage('Checkout Code'){
            steps{
                checkout scm
            }
        }

        stage('Authenticate to AWS & Connect to EKS') {
            steps {
                sh '''
                    echo "Configuring AWS CLI..."
                    aws --version

                    aws eks update-kubeconfig \
                      --region ${AWS_DEFAULT_REGION} \
                      --name ${EKS_CLUSTER}
                '''
            }
        }

        stage('Apply Kubernetes Manifests'){
            steps{
                sh """
                    echo Applying Kubernetes manifests...
                    kubectl apply -f k8s/ -n ${K8S_NAMESPACE}
                """
            }
        }

        stage('Update Deployment Image'){
            steps{
                sh """
                    echo Updating deployment image to ${NEW_IMAGE}...
                    kubectl set image deployment/php-app php=${NEW_IMAGE} -n ${K8S_NAMESPACE}
                """
            }
        }

        stage('Verify Rollout Status'){
            steps{
                script{
                    try{
                        sh """
                            echo Verifying rollout status...
                            kubectl rollout status deployment/php-app -n ${K8S_NAMESPACE} --timeout=300s
                        """
                    }catch(err){
                        echo "Rollout failed — initiating rollback..."
						sh """
                            kubectl rollout undo deployment/php-app -n ${K8S_NAMESPACE}
                        """
						error("Rollback executed due to failed deployment.")
                    }
                }
                    
            }
        }
    }

    post {
		success {
			emailext (
				subject: "PHP Project Deployment SUCCESS",
				body: """\
					Deployment Completed Successfully!

					Environment: Production (GKE)
					Image: ${NEW_IMAGE}

                    
                    PHP application is now live.

					""",
				to: "janitha1717@gmail.com"
			)
		}

		failure {
			emailext (
				subject: "PHP Project Deployment FAILED",
				body: """\
					Deployment Failed!

					Automatic rollback was executed.

					Check Jenkins console logs for detailed error.
					""",
				to: "janitha1717@gmail.com"
			)
		}
	
    }
}
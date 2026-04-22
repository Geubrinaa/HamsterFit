@Library('jenkins-ci-automation@sharelib') _

akarintiPipeline([
        allowedBranch: ["development"],
        infra        : [
                        "dev":
                             ["branch":"development", "setup":"ait-internal-dev"]
                       ],
        targetPort   : 80,
        buildEnv     : "yes",
        lang         : "php",
        addPubUrl    : "yes",
        dockerfile   : "Dockerfile"
])

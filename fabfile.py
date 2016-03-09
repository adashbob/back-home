from __future__ import with_statement
from fabric.api import *

env.hosts = ['localhost']

@task
def rebuildDatabase():
    "Rebuild Database"
    local('mysqladmin -uroot -p drop collectify')
    local('mysqladmin -uroot -p create collectify')

@task
def loadFixture():
    "Rebuild Databse and load Fixtures"
    rebuildDatabase()
    local('php src/Collectify/DataFixtures/LoadFixtures.php user')
    local('php src/Collectify/DataFixtures/LoadFixtures.php category')
    local('php src/Collectify/DataFixtures/LoadFixtures.php item')

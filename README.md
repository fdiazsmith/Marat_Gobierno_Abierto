# Gobierno Abierto

## Development Guide

## Getting Started

In order to develop and compile the code for this project you will first need to follow the steps under [Setting up your environment](#setup). After you have the *environment dependencies* installed, you can run any of the [grunt](http://gruntjs.com/) commands listed in this Development Guide.

---

###Running Grunt

Grunt acts as the main interface for all development and build procedures. Each task is configured within a central file called `Gruntfile.js`. Below is a listing of the primary Grunt commands used in this project.

####grunt install
`$ grunt install`

After the *environment dependencies* are installed (See [Setting up your environment](#setup)) you can run this command to install specifi project dependencies.

####grunt dev-start

`$ grunt dev-start`

This command will start the vagrant virtual machine. Be patient, the process takes a moment to provision itself. 

Once the provision is complete you can:

1. Log into the local Wordpress dashboard:
	
	[**http://localhost:8080/wp-admin/**](http://localhost:8080/wp-admin/) 
	
	**Username** : `admin`
	
	**Password** : `vagrant`
	
2. Access phpMyAdmin:

	[**http://localhost:8080/phpmyadmin/**](http://localhost:8080/phpmyadmin/)
	
	**Username** : `wordpress`
	
	**Password** : `wordpress`

####grunt dev-stop

`$ grunt dev-stop`

This command will halt the vagrant process and gracefully shutdown the virtualbox machine.

####grunt build

`$ grunt build`

This command will run all the necessary tasks for compiling and packaging the code into the dist directory.

---

### <a name="setup"></a>Setting up your environment:

For this project the entire server environment can be simulated within a virutal machine using [**VirtualBox**](https://www.virtualbox.org) , [**Vagrant**](https://www.vagrantup.com) and [**VagrantPress**](https://github.com/chad-thompson/vagrantpress/blob/master/README.md). This allows each developer to work with an identical environment that is portable.

Follow these steps to set up your development environment:

####Step 1: Installing node

There are several ways of installing node. The recommended method is to use a package manager like hommebrew.

If you are running homebrew installation of node is simple:

`brew install node`

If you are not running homebrew or similar (macports), you can [install node directly by downloading it from the website](http://nodejs.org/).

####Step 2: Installing npm

If you used the homebrew method of installing node you should already have `npm`. Otherwise it can be obtained from the node.js website (see link above).

####Step 3: Installing grunt-cli

Using `npm`, run the following command to install `grunt-cli` globally:

`npm install -g grunt-cli`

#### Step 4 : Install VirtualBox & Vagrant

The entire server environment can be simulated on a local development machine using [**VirtualBox**](https://www.virtualbox.org/) and [**Vagrant**](https://www.vagrantup.com).


1. To install **VirtualBox**, head over to the [downloads page](https://www.virtualbox.org/wiki/Downloads) and download the 64bit environment for your system. Open the installer and follow the instructions to complete the installation.

2. To install **Vagrant** head over to the [downloads page](https://www.vagrantup.com/downloads) and get the appropriate installer or package for your platform. Then install it using standard procedures for your operating system. The installer will automatically add vagrant to your system path so that it is available in terminals. If it is not found, please try logging out and logging back in to your system (this is particularly necessary sometimes for Windows).

**NOTE:** If you have an old version of Vagrant 1.0.x installed via RubyGems, you should remove it prior to installing a newer version of Vagrant.

####Step 5: Clone the Repository & Install Project Dependencies

Start by cloning repository using `git clone`, then navigate into your local project directory. 

Once you are within the root of the project directory run the command `$ npm install`, which will fetch `npm packages`. Then run `$ grunt install` to install `bower dependencies`, and prepare the workspace.

---
### Additional References & Resources

* [Virutal Box Documentation](https://www.virtualbox.org/wiki/Documentation)

* [Vagrant Documentation](https://docs.vagrantup.com/v2/)

* [VagrantPress Info](https://github.com/chad-thompson/vagrantpress/blob/master/README.md)

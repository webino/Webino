Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/xenial64"
  #config.vm.box = "webino.local"
  #config.vm.box_url = "https://media.webino.sk/vagrant/webino.local.box"
  #config.vm.synced_folder "public", "/var/www/public"
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.provider "virtualbox" do |v|
    v.customize [ "modifyvm", :id, "--uartmode1", "disconnected" ]
  end
end

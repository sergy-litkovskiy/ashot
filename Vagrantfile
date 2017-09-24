# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::configure("2") do |config|

  config.vm.define "ashot", autostart: false do |ashot|
    ashot.vm.provider :virtualbox do |vb|
      # Set configuration options for the VirtualBox image.
      vb.customize ["modifyvm", :id, "--memory", "4096", "--cpus", "2", "--ioapic", "on"]
    end
    ashot.vm.box = "ubuntu/trusty64"
    ashot.vm.hostname = "ashot.kiev.loc"
    if Vagrant::Util::Platform.windows?
      ashot.vm.provider :virtualbox do |vb|
        # Set configuration options for the VirtualBox image.
        vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate//vagrant","1"]
      end
      ashot.vm.synced_folder ".", "/var/www/ashot.kiev.loc", :mount_options => ["dmode=777","fmode=777"], :owner => "vagrant", :group => "vagrant"
    else
      ashot.vm.synced_folder ".", "/var/www/ashot.kiev.loc", :nfs => { :mount_options => ["dmode=777","fmode=777"] }
    end
    ashot.vm.network :private_network, ip: "192.168.50.25"

    # Run this scripts after image was runned for the first time.
    ashot.vm.provision :shell, path: "vagrant/shell/web.sh"
  end
end
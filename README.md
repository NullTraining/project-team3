# project-team3
Team 3 project

To start using Vagrant:

## Step 1
Copy `Vagrantfile.dist` to `Vagrantfile`

- if you dont have NFS, edit line 9 to look like:

```
config.vm.synced_folder ".", "/vagrant"
```
## Step 2
Run `vagrant up`

## Step 3
Add to hosts file (on your laptop) (Linux: /etc/hosts , Mac: /private/etc/hosts, Windows: google :) )
```
10.0.60.80	www.bob.loc
10.0.60.80	test.bob.loc
```

## Step 4
Open `https://www.bob.loc`. It should complain about broken certificate, just allow it. If you see 'Ready to rumble' in your browser, Vagrant setup works!

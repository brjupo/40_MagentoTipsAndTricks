# Configuration for production environment

# Infrastructure

1 Balancer

3 Web Servers

1 Database

1 Slave Dabatabase*

For servers details, see 055_Recommended_infrastructure.md

# Steps

## Remember symbolic link

````bash
# Due to MECHANICAL Hard Drive Disc, we MUST use the minimum shared directories
 
# TODAY We have this symbolic links
# Verify that ALL directories, in /mnt/shared/ exists!
~/app/pub/media -> /mnt/shared/media
~/app/pub/static -> /mnt/shared/static
# ~/app/app/etc -> /mnt/shared/etc IS NOT USED DUE TO ERRORS WITH GIT
# ~/app/var -> /mnt/shared/var IS NOT USED DUE TO ERRORS WITH PRODUCTION MODE!
~/app/var/export -> /mnt/shared/var/export
~/app/var/import ->  /mnt/shared/var/import
# For this reason, we rsync the server B and C with the content of server A
````

## Remember services and configuration

### REDIS
We use Redis

### JS & CSS

#### Minify JS y CSS

#### Do NOT merge JS neither CSS  [JS takes more time, CSS performance asks us to split the file]
pub/static/_cache MUST NO BE USED!!, due to symlinked directories

#### Do NOT bundle JS [Takes more time]

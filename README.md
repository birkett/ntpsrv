# NTP Server Appliance

Built using RaspberryPi and Adafruit GPS Hat hardware.

Includes Dropbear SSH daemon, Ntpd, gpsd, pps-tools and a PHP web status interface.

Default credentials: `root / password`, network will use DHCP.

### Building
`./scripts/build.sh`

This has only been tested on a Debian Linux host.

### Debugging
To run the system in an emulated machine: `./scripts/qemu.sh`

The internal web server can be run locally, stand-alone: `php -S 0.0.0.0:8080 -t root/var/www/public/`

### Retargeting
Currently, this targets a RaspberryPi 2 B+ v1.1 (bcm2709).

To change the target board, the kernel config will need updating accordingly.

Ensure the DTB files are also updated, see `scripts/versions.sh` for the file that gets copied to the boot partition.

### File systems
 * bootfs is built as a 64mb FAT32 partition.
   * This is set in `scripts/build.sh` - the partition must be FAT32 for the boot code to properly load the firmware and kernel.
 * rootfs is built as a 32mb EXT2 partition.
   * This is set in the Buildroot target config.

### Updating Buildroot / Busybox / Kernel
#### Buildroot
Update Buildroot first. Bump the version number in `scripts/versions.sh` then copy the current config, run `make menuconfig`, and re-save. Address any old / deprecated config options.

#### Busybox
Busybox can be updated by selecting the new version in Buildroot, copy the current config, then `make menuconfig` and address any issues.

#### Kernel
The Linux kernel can be bumped by changing `LINUX_GIT_HASH` in `scripts/versions.sh`, copy the current config, then `make oldconfig` to address any missing / removed options.

See `configs/linux/README.md` for how to set up the cross compile toolchain.

### References

http://www.unixwiz.net/techtips/raspberry-pi3-gps-time.html

# Linux Kernel Config
Built from official Raspberry Pi kernel sources:
https://github.com/raspberrypi/linux

## Build Instructions
* Generate the toolchain using buildroot
* Add `$BUILDROOT/output/host/bin` and `$BUILDROOT/output/host/usr/bin` to PATH on the shell where we will compile the kernel
* Generate a default config, `bcmrpi_defconfig` for RPI1, `bcm2709_defconfig` for RPI2:
```shell
make ARCH=arm KERNEL=kernel CROSS_COMPILE=arm-buildroot-linux-musleabihf- <config name>
```
* Configure the kernel:
```shell
make ARCH=arm CROSS_COMPILE=arm-buildroot-linux-musleabihf- menuconfig
```
* Build:
```shell
make ARCH=arm CROSS_COMPILE=arm-buildroot-linux-musleabihf- -j8
```

Kernel image will be at `arch/arm/boot/zImage` and DTB files in `arch/arm/boot/dts/*.dtb`

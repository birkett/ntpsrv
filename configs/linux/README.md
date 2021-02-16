# Linux Kernel Config
Built from official Raspberry Pi kernel sources:
https://github.com/raspberrypi/linux

Currently using tag:
`raspberrypi-kernel_1.20210201-1`

Version `5.10.11`

## Build Instructions
* Generate the toolchain using buildroot
* Add `$BUILDROOT/output/host/bin` and `$BUILDROOT/output/host/usr/bin` to PATH on the shell where we will compile the kernel
* Generate the raspi1 default config:
```shell
cd linux
KERNEL=kernel
make ARCH=arm CROSS_COMPILE=arm-buildroot-linux-musleabihf- bcmrpi_defconfig
```
* Configure the kernel:
```shell
make ARCH=arm CROSS_COMPILE=arm-buildroot-linux-musleabihf- menuconfig
```
* Build:
```shell
make ARCH=arm CROSS_COMPILE=arm-buildroot-linux-musleabihf- -j8
```

Kernel image will be at `arch/arm/boot/zImage` and DTB files in `arch/arm/boot/dtb/*.dtb`

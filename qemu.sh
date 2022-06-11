#!/bin/bash

source versions.sh

qemu-system-arm \
  -M raspi2b \
  -cpu arm1176 \
  -m 1G \
  -serial stdio \
  -hda build/buildroot-"$BUILDROOT_VERSION"/output/images/rootfs.ext2 \
  -append "console=ttyAMA0" \
  -dtb build/buildroot-"$BUILDROOT_VERSION"/output/build/linux-"$LINUX_GIT_HASH"/arch/arm/boot/dts/"$TARGET_DTB" \
  -kernel build/buildroot-"$BUILDROOT_VERSION"/output/images/zImage

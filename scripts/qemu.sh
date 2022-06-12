#!/bin/bash

source scripts/versions.sh

qemu-system-arm \
  -M raspi2b \
  -cpu arm1176 \
  -m 1G \
  -serial stdio \
  -hda "$PROJECT_ROOT"/build/buildroot-"$BUILDROOT_VERSION"/output/images/rootfs.ext2 \
  -append "console=ttyAMA0 root=/dev/mmcblk0" \
  -dtb "$PROJECT_ROOT"/build/buildroot-"$BUILDROOT_VERSION"/output/build/linux-"$LINUX_GIT_HASH"/arch/arm/boot/dts/"$TARGET_DTB" \
  -kernel "$PROJECT_ROOT"/build/buildroot-"$BUILDROOT_VERSION"/output/images/zImage

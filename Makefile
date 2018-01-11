# Docker tasks

# Build steps
all: 4-9

# Version 4.9
4-9: 4-9-alpine 4-9-debian

# recursive use of make
4-9-alpine:
		$(MAKE) -C ./4.9/alpine

4-9-debian:
		$(MAKE) -C ./4.9/debian

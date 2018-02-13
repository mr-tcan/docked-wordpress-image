# Docker tasks

# Docker Hub user/organization
NAMESPACE = dockium
# WordPress version
VERSION = 4.9.4
# Docker image revision
REVISION = 0

# Build steps
all: debian

debian:
	# tag: dockium/wordpress:4.9.1_2
	docker build -t $(NAMESPACE)/wordpress:$(VERSION)_$(REVISION) ./

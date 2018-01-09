# Docker tasks

# Docker Hub user/organization
NAMESPACE = dockium
# WordPress version
VERSION = 4.9.1
# Docker image revision
REVISION = 0

# Build steps
all: 4-9

4-9:
	# tag: dockium/wordpress:4.9.1_0
	docker build -t $(NAMESPACE)/wordpress:$(VERSION)_$(REVISION) ./4.9

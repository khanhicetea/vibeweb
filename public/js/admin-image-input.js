function imageInput(config = {}) {
    return {
        value: config.value ?? '',
        directory: config.directory ?? 'uploads',
        uploadUrl: config.uploadUrl,
        preview: null,
        uploading: false,
        error: null,

        get displayUrl() {
            if (this.preview) {
                return this.preview;
            }

            return this.resolveUrl(this.value);
        },

        resolveUrl(path) {
            if (!path) {
                return null;
            }

            if (path.startsWith('http://') || path.startsWith('https://') || path.startsWith('/')) {
                return path;
            }

            return `/${path}`;
        },

        onFileSelect(event) {
            const input = event.target;
            const file = input.files[0];

            if (!file) {
                return;
            }

            this.error = null;
            this.clearPreview();
            this.preview = URL.createObjectURL(file);
            this.upload(file, input);
        },

        async upload(file, input) {
            this.uploading = true;
            this.error = null;

            const formData = new FormData();
            formData.append('image', file);
            formData.append('directory', this.directory);

            try {
                const response = await fetch(this.uploadUrl, {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData,
                });

                const payload = await response.json();

                if (!response.ok) {
                    const message = payload.errors?.image?.[0] ?? payload.message ?? 'Upload failed.';

                    throw new Error(message);
                }

                this.value = payload.path;
                this.clearPreview();
            } catch (error) {
                this.error = error.message ?? 'Upload failed.';
                this.clearPreview();
            } finally {
                this.uploading = false;

                if (input) {
                    input.value = '';
                }
            }
        },

        clear() {
            this.value = '';
            this.error = null;
            this.clearPreview();
        },

        clearPreview() {
            if (this.preview) {
                URL.revokeObjectURL(this.preview);
                this.preview = null;
            }
        },
    };
}

function imagesInput(config = {}) {
    const source = Array.isArray(config.values) && config.values.length ? config.values : [''];

    return {
        images: source.map((path) => ({
            id: crypto.randomUUID(),
            path,
        })),
        max: config.max ?? null,
        uploadUrl: config.uploadUrl,
        directory: config.directory ?? 'uploads',
        name: config.name ?? 'images',

        add() {
            if (this.max && this.images.length >= this.max) {
                return;
            }

            this.images.push({
                id: crypto.randomUUID(),
                path: '',
            });
        },

        remove(index) {
            if (this.images.length > 1) {
                this.images.splice(index, 1);
            }
        },

        move(index, direction) {
            const nextIndex = index + direction;

            if (nextIndex < 0 || nextIndex >= this.images.length) {
                return;
            }

            [this.images[index], this.images[nextIndex]] = [this.images[nextIndex], this.images[index]];
        },
    };
}
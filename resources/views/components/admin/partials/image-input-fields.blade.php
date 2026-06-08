<label class="form-label" x-show="label" x-text="label" :for="inputId"></label>

<div class="admin-image-input__frame">
    <div class="admin-image-input__preview" x-show="displayUrl" x-cloak>
        <img :src="displayUrl" alt="Image preview">
    </div>

    <div class="admin-image-input__placeholder" x-show="!displayUrl" x-cloak>
        <i class="ti ti-photo icon" aria-hidden="true"></i>
        <span>No image</span>
    </div>

    <input
        class="admin-image-input__file"
        type="file"
        accept="image/*"
        :id="inputId"
        :disabled="uploading"
        x-on:change="onFileSelect($event)"
    >
</div>

<div class="admin-image-input__actions">
    <label
        class="btn btn-outline-secondary btn-icon"
        :for="inputId"
        :class="{ 'disabled': uploading }"
        title="Choose image"
        aria-label="Choose image"
    >
        <i class="ti ti-upload icon" aria-hidden="true"></i>
    </label>

    <button
        class="btn btn-outline-danger btn-icon"
        type="button"
        x-show="value || preview"
        x-on:click="clear()"
        :disabled="uploading"
        title="Remove image"
        aria-label="Remove image"
    >
        <i class="ti ti-trash icon" aria-hidden="true"></i>
    </button>

    <span class="admin-image-input__status text-secondary" x-show="uploading" title="Uploading">
        <i class="ti ti-loader icon admin-image-input__spinner" aria-hidden="true"></i>
    </span>
</div>

<div class="text-danger small mt-1" x-show="error" x-text="error"></div>
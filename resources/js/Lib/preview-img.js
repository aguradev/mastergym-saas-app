const PreviewImageFile = (file) => {
    const createUrl = URL.createObjectURL(file);
    return createUrl;
};

export default PreviewImageFile;

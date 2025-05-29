// DOM Elements
        const profileDetailsTab = document.getElementById('profileDetailsTab');
        const securityTab = document.getElementById('securityTab');
        const profileDetailsContent = document.getElementById('profileDetailsContent');
        const securityContent = document.getElementById('securityContent');

        const editBtn = document.getElementById('editBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const saveChangeBtn = document.getElementById('saveChangeBtn');
        
        const inputsToToggle = [
            document.getElementById('fullName'),
            document.getElementById('email'),
            document.getElementById('title')
        ];
        const uploadImageBtn = document.getElementById('uploadImageBtn');
        const removePhotoBtn = document.getElementById('removePhotoBtn');
        const profileAvatar = document.getElementById('profileAvatar');

        // Store initial values for cancellation
        let initialValues = {};
        inputsToToggle.forEach(input => initialValues[input.id] = input.value);
        let initialAvatarSrc = profileAvatar.src;
        const defaultAvatarSrc = "https://placehold.co/120x120/E2E8F0/4A5568?text=Avatar";

        // --- Functions ---

        function setInputsEditable(isEditable) {
            inputsToToggle.forEach(input => {
                input.readOnly = !isEditable;
                if (isEditable) {
                    input.classList.remove('input-readonly-bg');
                } else {
                    input.classList.add('input-readonly-bg');
                }
            });
        }

        function toggleEditModeButtons(isEditing) {
            if (isEditing) {
                editBtn.classList.add('hidden');
                cancelBtn.classList.remove('hidden');
                saveChangeBtn.classList.remove('hidden');
                uploadImageBtn.classList.remove('hidden');
                removePhotoBtn.classList.remove('hidden');
            } else {
                editBtn.classList.remove('hidden');
                cancelBtn.classList.add('hidden');
                saveChangeBtn.classList.add('hidden');
                uploadImageBtn.classList.add('hidden');
                removePhotoBtn.classList.add('hidden');
            }
        }

        function updateTabStyles(activeTabElement, inactiveTabElement) {
            activeTabElement.classList.add('active-tab');
            activeTabElement.classList.remove('inactive-tab');

            inactiveTabElement.classList.add('inactive-tab');
            inactiveTabElement.classList.remove('active-tab');
        }
        
        function showMessage(text, type = 'success', duration = 3000) {
            // Remove any existing message box first
            const existingMessageBox = document.querySelector('.message-box');
            if (existingMessageBox) {
                existingMessageBox.remove();
            }

            const messageBox = document.createElement('div');
            messageBox.textContent = text;
            messageBox.className = `message-box ${type}`; // e.g., message-box success
            document.body.appendChild(messageBox);
            setTimeout(() => {
                messageBox.remove();
            }, duration);
        }

        // --- Event Listeners ---

        profileDetailsTab.addEventListener('click', () => {
            profileDetailsContent.classList.remove('hidden');
            securityContent.classList.add('hidden');
            updateTabStyles(profileDetailsTab, securityTab);
        });

        securityTab.addEventListener('click', () => {
            securityContent.classList.remove('hidden');
            profileDetailsContent.classList.add('hidden');
            updateTabStyles(securityTab, profileDetailsTab);
        });

        editBtn.addEventListener('click', () => {
            inputsToToggle.forEach(input => initialValues[input.id] = input.value);
            initialAvatarSrc = profileAvatar.src;
            setInputsEditable(true);
            toggleEditModeButtons(true);
        });

        cancelBtn.addEventListener('click', () => {
            inputsToToggle.forEach(input => input.value = initialValues[input.id]);
            profileAvatar.src = initialAvatarSrc;
            setInputsEditable(false);
            toggleEditModeButtons(false);
        });

        saveChangeBtn.addEventListener('click', () => {
            console.log('Saving changes:');
            inputsToToggle.forEach(input => {
                const labelElement = document.querySelector(`label[for='${input.id}']`);
                console.log(`${labelElement ? labelElement.textContent : input.id}:`, input.value);
            });
            console.log('Avatar URL:', profileAvatar.src);

            initialValues = {}; // Reset and update
            inputsToToggle.forEach(input => initialValues[input.id] = input.value);
            initialAvatarSrc = profileAvatar.src;

            setInputsEditable(false);
            toggleEditModeButtons(false);
            showMessage('Profile updated successfully!', 'success');
        });

        uploadImageBtn.addEventListener('click', () => {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.onchange = (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        profileAvatar.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            };
            fileInput.click();
        });

        removePhotoBtn.addEventListener('click', () => {
            profileAvatar.src = defaultAvatarSrc;
        });

        // --- Initial State Setup ---
        window.onload = function() {
            setInputsEditable(false); // Inputs start as readonly
            inputsToToggle.forEach(input => input.classList.add('input-readonly-bg')); // Apply readonly bg style
            toggleEditModeButtons(false); // Show "Edit" button, hide others
            updateTabStyles(profileDetailsTab, securityTab); // Set initial active tab
            
            // Store initial form values for cancellation
            inputsToToggle.forEach(input => initialValues[input.id] = input.value);
            initialAvatarSrc = profileAvatar.src;
        };
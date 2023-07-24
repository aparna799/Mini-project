import face_recognition
import numpy as np
import os


# Reading faces from the existing directory
known_faces = []
known_faces_encoding = []


def img_reader(file_path):
    
    name = file_path.split("\\")[-1].split('.')[0]
    known_faces.append(name)
    img = face_recognition.load_image_file(file_path)
    face_location = face_recognition.face_locations(img)
    if len(face_location) > 0:
        img_encoding = face_recognition.face_encodings(img, face_location)[0]
        known_faces_encoding.append(img_encoding)
    else:
        print(f"No faces found in the image: {file_path}")


folder = 'uploads'  # Folder containing known faces
photos_path = os.path.join(os.getcwd(), folder)
imgs = [os.path.join(photos_path, file) for file in os.listdir(photos_path)]

for img in imgs:
    img_reader(img)


# Taking a new image and finding the best match from the existing folder based on face distance

def find_match(img_path):
    if not os.path.exists(img_path):
        print(f"Image file not found: {img_path}")
        return "no match found..!"

    img = face_recognition.load_image_file(img_path)
    face_location = face_recognition.face_locations(img)
    if len(face_location) == 0:
        print(f"No faces found in the input image: {img_path}")
        return "no match found..!"

    face_encoding = face_recognition.face_encodings(img, face_location)[0]

    matches = face_recognition.compare_faces(known_faces_encoding, face_encoding)
    face_distance = face_recognition.face_distance(known_faces_encoding, face_encoding)
    best_match_index = np.argmin(face_distance)
    if matches[best_match_index]:
        name = known_faces[best_match_index]
        return name
    else:
        return "no match found..!"


input_img_path = input("Enter the image path: ")
print(find_match(input_img_path))

import React, { useState, useEffect } from "react";
import axios from "axios";

const CarouselRecent = () => {
  const [currentIndex, setCurrentIndex] = useState(0);
  const [recentWorks, setRecentWorks] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8000/api/img/manga", {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        }
      })
      .then((res) => {
        // Stocker les données d'images récentes dans l'état local
        setRecentWorks(res.data);
      })
      .catch((error) => {
        console.error(
          "Une erreur s'est produite lors de la récupération des images : ",
          error
        );
      });
    axios
      .get("http://localhost:8000/api/oeuvres", {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        }
      })
      .then((res) => {
        // Tri des œuvres par date de création
        const sortedWorks = res.data.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
        // Limiter aux 6 œuvres les plus récentes
        const limitedWorks = sortedWorks.slice(0, 6);
        setRecentWorks(limitedWorks);
      })
      .catch((error) => {
        console.error(
          "Une erreur s'est produite lors de la récupération des oeuvres : ",
          error
        );
      });
  }, []);

  const nextSlide = () => {
    setCurrentIndex((prevIndex) =>
      prevIndex === recentWorks.length - 1 ? 0 : prevIndex + 1
    );
  };

  const prevSlide = () => {
    setCurrentIndex((prevIndex) =>
      prevIndex === 0 ? recentWorks.length - 1 : prevIndex - 1
    );
  };

  return (
    <div className="relative w-2/4">
      <div className="flex justify-center">
        <div className="w-full">
          <div className="flex justify-around">
            {recentWorks.length > 0 && recentWorks.map((work, index) => (
              <div
                key={index}
                className={`w-full h-full flex justify-center items-center transition-opacity duration-500 ${index === currentIndex ? "" : "hidden"}`}
              >
                <img
                  src={`http://localhost:8000/api/img/manga/${work.picture}`}
                  alt={work.name}
                  className="object-cover h-52"
                />
              </div>
            ))}
          </div>
        </div>
      </div>
      0
      <button
        onClick={prevSlide}
        className="absolute top-1/2 -translate-y-1/2 left-0 z-10 bg-gray-800/50 text-white rounded-full p-2"
      >
        {"<"}
      </button>
      <button
        onClick={nextSlide}
        className="absolute top-1/2 -translate-y-1/2 right-0 z-10 bg-gray-800/50 text-white rounded-full p-2"
      >
        {">"}
      </button>
    </div>
  );
};

export default CarouselRecent;

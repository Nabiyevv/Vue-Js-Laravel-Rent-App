<script>
import partyIcon from '../assets/categories/PartyAndEvents.svg'
import gamingIcon from '../assets/categories/Gaming.svg'
import photographyIcon from '../assets/categories/Photography.svg'
import musicIcon from '../assets/categories/Music.svg'
import clothingIcon from '../assets/categories/Clothing.svg'
import kitchenIcon from '../assets/categories/Kitchen.svg'
import booksIcon from '../assets/categories/Books.svg'
import transportIcon from '../assets/categories/Transport.svg'
import electronicsIcon from '../assets/categories/Electronics.svg'
import fitnessIcon from '../assets/categories/Fitness.svg'

export function getCategories() {
  return [
    {
      id:0,
      label: 'Party and Events',
      icon: partyIcon,
      description: ' etc.',
    },
    {
      id:1,
      label: 'Gaming',
      icon: gamingIcon,
      description: 'Consoles, Games, Outdoor toys, Toys, Virtual Reality, etc.',
    },
    {
      id:2,
      label: 'Photography',
      icon: photographyIcon,
      description: ' Photography Accesories, Cameras, Lens, Batteries, Case, etc.'
    },
    {
      id:3,
      label: 'Music',
      icon: musicIcon,
      description: 'Music Accessories, Music Players, Musical Instruments, Sound Equipments, etc.'
    },
    {
      id:4,
      label: 'Clothing',
      icon: clothingIcon,
      description: "Children's Clothing, Clothing Accessories(Sunglasses, Handbags, etc.), Men's Clothing, Women's Clothing, Costumes, Footware, etc."
    },
    {
      id:5,
      label: 'Kitchen',
      icon: kitchenIcon,
      description: 'Cookware, Cutlery, Kitchen Appliances, Tableware, Refrigerators, Microwave and Ovens, etc.'
    },
    {
      id:6,
      label: 'Books',
      icon: booksIcon,
      description: 'Fictional / Non-fictionl Novels, Comics, Manga, etc.'
    },
    {
      id:7,
      label: 'Transport',
      icon: transportIcon,
      description: 'Bicycles, Scooters, Cars, Bikes, Skates, Skateboards, etc.'
    },
    {
      id:8,
      label: 'Electronics',
      icon: electronicsIcon,
      description: 'Computers, Grooming appliances, Laptops, Storage Devices, Mouse, Keyboard, Phones, Cables and accessories, etc.'
    },
    {
      id:9,
      label: 'Fitness',
      icon: fitnessIcon,
      description: 'Gym Equipments, Massage chairs, Steamer, etc.'
    },
  ]
}

</script>

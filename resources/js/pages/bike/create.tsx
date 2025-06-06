import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import React from 'react'
import { useForm } from '@inertiajs/react'

const create = () => {
    const {post,errors,data,setData,processing,reset} = useForm({
        name: '',
        brand: '',
        model: '',
        color: '',
        type: '',
        size: '',
        price: '',
        description: '',
        image: null, 
    })

    const SubmitEvent = (e) => {
        e.preventDefault()
        post(route('bike.store'), {
            onSuccess: () => {
                reset()
                alert('Bike added successfully!')
            },
        })
    }

    return (
        <div className="p-6 max-w-2xl mx-auto">
            <h2 className="text-2xl font-bold mb-6">Add New Bike</h2>
            <form onSubmit={SubmitEvent} className="space-y-4">
                <div className="space-y-2">
                    <Label htmlFor="name">Bike Name</Label>
                    <Input 
                        id="name" 
                        name="name"
                        value={data.name}
                        onChange={e => setData('name', e.target.value)}
                        placeholder="Enter bike name" 
                    />
                    {errors.name && <div className="text-red-500 text-sm">{errors.name}</div>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="brand">Brand</Label>
                    <Input 
                        id="brand" 
                        name="brand"
                        value={data.brand}
                        onChange={e => setData('brand', e.target.value)}
                        placeholder="Enter bike brand" 
                    />
                    {errors.brand && <div className="text-red-500 text-sm">{errors.brand}</div>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="model">Model</Label>
                    <Input 
                        id="model" 
                        name="model"
                        value={data.model}
                        onChange={e => setData('model', e.target.value)}
                        placeholder="Enter bike model" 
                    />
                    {errors.model && <div className="text-red-500 text-sm">{errors.model}</div>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="color">Color</Label>
                    <Input 
                        id="color" 
                        name="color"
                        value={data.color}
                        onChange={e => setData('color', e.target.value)}
                        placeholder="Enter bike color" 
                    />
                    {errors.color && <div className="text-red-500 text-sm">{errors.color}</div>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="type">Type</Label>
                    <Input 
                        id="type" 
                        name="type"
                        value={data.type}
                        onChange={e => setData('type', e.target.value)}
                        placeholder="Enter bike type" 
                    />
                    {errors.type && <div className="text-red-500 text-sm">{errors.type}</div>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="size">Size</Label>
                    <Input 
                        id="size" 
                        name="size"
                        value={data.size}
                        onChange={e => setData('size', e.target.value)}
                        placeholder="Enter bike size" 
                    />
                    {errors.size && <div className="text-red-500 text-sm">{errors.size}</div>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="price">Price</Label>
                    <Input 
                        id="price" 
                        name="price"
                        type="number"
                        value={data.price}
                        onChange={e => setData('price', e.target.value)}
                        placeholder="Enter bike price" 
                    />
                    {errors.price && <div className="text-red-500 text-sm">{errors.price}</div>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="description">Description</Label>
                    <Input 
                        id="description" 
                        name="description"
                        value={data.description}
                        onChange={e => setData('description', e.target.value)}
                        placeholder="Enter bike description" 
                    />
                    {errors.description && <div className="text-red-500 text-sm">{errors.description}</div>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="image">Image</Label>
                    <Input 
                        id="image" 
                        name="image"
                        type="file" 
                        onChange={e => setData('image', e.target.files[0])}
                        accept="image/*" 
                    />
                    {errors.image && <div className="text-red-500 text-sm">{errors.image}</div>}
                </div>

                <Button type="submit" className="w-full" disabled={processing}>
                    {processing ? 'Adding...' : 'Add Bike'}
                </Button>
            </form>
        </div>
    )
}

export default create